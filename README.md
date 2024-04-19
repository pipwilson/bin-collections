I wrote this because my council's published bin collection timetable [is not always accurate](https://philwilson.org/blog/2023/10/when-my-bins-go-out/).

1. Use the tool at https://www.bathnes.gov.uk/webforms/waste/collectionday/ to look up your bin collection schedule and monitor XHR requests to work out the route key for your address.

2. Create a `.env` file alongside index.php and in it put:

`COLLECTION_ROUTE_KEY=XXXXXXXXXXX`

3. Replace XXXXXXXXXXX with the route key you found.

Done.