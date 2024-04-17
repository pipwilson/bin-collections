1. Use the tool at https://www.bathnes.gov.uk/webforms/waste/collectionday/ and monitor XHR requests to work out the route key for your address.

2. Create a `.env` file alongside index.php and in it put:

`COLLECTION_ROUTE_KEY=XXXXXXXXXXX`

3. Replace XXXXXXXXXXX with the route key you found.
