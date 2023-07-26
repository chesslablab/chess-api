# GET /autocomplete

Returns autocomplete data for chess events and players.

Example:

```text
curl https://pchess.net/api/autocomplete
```

Response:

```text
{
  "events": [
    { "Event": "1/2 Coupe de France" },
    { "Event": "1/4 Coupe de France" },
    ...
    { "Event": "Zvenigorodskaya Open A" },
    { "Event": "Zwolle op" }
  ],
  "players": [
    { "name": "A-Ali,Sali Abbas Abdulzahra" },
    { "name": "Aaberg,A" },
    ...
    { "name": "Zytogorski, Adolf" },
    { "name": "Zyulyarkin" }
  ]
}
```
