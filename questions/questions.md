*Question 1*


From: marissa@startup.com
Subject:  Bad design

Hello,

Sorry to give you the kind of feedback that I know you do not want to hear, but I really hate the new dashboard design. Clearing and deleting indexes are now several clicks away. I am needing to use these features while iterating, so this is inconvenient.

Thanks,
Marissa

*Reply 1*

Hi Marissa,

Thank you for your honest feedback on the dashboard design. I understand the additional steps for clearing and deleting indexes can be a bit inconvenient during testing.

While this design might add safety in a production environment, I see how it affects your current workflow.

To help, you might find this code snippet useful for more direct index management during testing: [Docs]( https://www.algolia.com/doc/guides/sending-and-managing-data/manage-indices-and-apps/manage-indices/how-to/delete-indices/#delete-indices-with-the-api.)

Your insights are really valuable to us. If you have more suggestions or need assistance, feel free to reach out.

--

*Question 2*:

From: carrie@coffee.com
Subject: URGENT ISSUE WITH PRODUCTION!!!!

Since today 9:15am we have been seeing a lot of errors on our website. Multiple users have reported that they were unable to publish their feedbacks and that an alert box with "Record is too big, please contact enterprise@algolia.com".

Our website is an imdb like website where users can post reviews of coffee shops online. Along with that we enrich every record with a lot of metadata that is not for search. I am already a paying customer of your service, what else do you need to make your search work?

Please advise on how to fix this. Thanks.


*Reply 2*:

Hi Carrie,

I'm sorry to hear you're facing issues with your website.

It sounds like the "Record is too big" error might be due to exceeding the record size limits of our service, which range from 10KB to 100KB based on your plan.

I suggest trimming non-search-related metadata (enrichments) from your records. This should help keep record sizes within limits and resolve the issue.

For guidance on managing record sizes, you might find this resource helpful: [Reducing Object Size Guide.](https://www.algolia.com/doc/guides/sending-and-managing-data/prepare-your-data/how-to/reducing-object-size/)

I would also recommend sending the records to Algolia asynchronously, if possible. This approach would help avoid disrupting the user experience and facilitate easier recovery

Let me know if this helps.

--

*Question 3*:


From: marc@hotmail.com
Subject: Error on website

Hi, my website is not working and here's the error:

![error message](./error.png)

Can you fix it please?

*Reply 3*:

Hi Marc,

Thank you for bringing this to our attention.

From the error message you've shared, it appears the issue might be related to a missing package from your previous search service, Elasticsearch.

Specifically, it seems connected to the 'searchkit' package, which you can find here: Searchkit Package.

To resolve this, I recommend going through your codebase and removing all references to the 'searchkit' package. This step should help in addressing the error.

If you encounter any difficulties or need further assistance with this process, please don't hesitate to reach out.
