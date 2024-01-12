<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$fileContent = file_get_contents("data/products.json");

$data = json_decode($fileContent, true);

$data = applyDiscount($data);

// Update the price range after discount.
$priceRanges = array_map(function ($item) {
  return $item['price_range'];
}, $data);

$data = updatePriceRangeIfNeeded($priceRanges, $data);

// Send to Algolia
sendToAlgolia($data);

echo "Done!";

#########################################
function applyDiscount(mixed $data): array
{
  $data = array_map(function ($item) {
    if ($item['categories'][0] === 'Cameras & Camcorders') {
      $item['price'] = round($item['price'] * 0.8, 0, PHP_ROUND_HALF_DOWN);
    }
    return $item;
  }, $data);
  return $data;
}

function updatePriceRangeIfNeeded(array $priceRanges, array $data): array
{
  return array_map(function ($item) use ($priceRanges) {

    if (!checkValidPriceRange($item['price'], $item['price_range'])) {
      $range = findPriceRange($item['price'], $priceRanges);

      if (!$range) {
        throw new Exception("No range found for price: {$item['price']}");
      }

      $item['price_range'] = $range;
    }

    return $item;
  }, $data);
}

function checkValidPriceRange($price, $range): bool
{
  // check for the case > 2000
  if (str_contains($range, ">")) {
    $min = trim(str_replace(">", "", $range));
    return $price >= $min;
  }

  // remaining cases x-y
  $range = explode('-', $range);

  $min = trim($range[0]);
  $max = trim($range[1]);

  return $price >= $min && $price <= $max;
}

/**
 * @param $price
 * @param $priceRanges
 * @return mixed
 */
function findPriceRange($price, $priceRanges): mixed
{
  foreach ($priceRanges as $range) {
    if (checkValidPriceRange($price, $range)) {
      return $range;
    }
  }
  return false;
}



function sendToAlgolia(array $data)
{
  $client = \Algolia\AlgoliaSearch\SearchClient::create(
    $_ENV['ALGOLIA_APP_ID'],
    $_ENV['ALGOLIA_ADMIN_API_KEY'],
  );

  $index = $client->initIndex($_ENV['ALGOLIA_INDEX']);

  $index->saveObjects($data, ['autoGenerateObjectIDIfNotExist' => true]);
}
