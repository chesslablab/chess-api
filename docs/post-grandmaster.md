# POST /grandmaster

Returns a chess game played by a random FIDE titled player.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| movetext | A portable game notation (PGN) movetext. | Yes |

## Example

```text
curl https://pchess.net/api/grandmaster \
  -H "Content-Type: application/json" \
  --data-raw '{
    "movetext": "1.e4 c6 2.Nc3"
  }'
```

```text
[
  {
    "id": 157019,
    "Event": "38th Olympiad",
    "Site": "Dresden GER",
    "Date": "2008.11.22",
    "White": "Can,E",
    "Black": "Nielsen,PH",
    "Result": "1/2-1/2",
    "WhiteElo": "2464",
    "BlackElo": "2662",
    "ECO": "B11",
    "FEN": null,
    "movetext": "1.e4 c6 2.Nc3 d5 3.Nf3 Bg4 4.h3 Bxf3 5.Qxf3 e6 6.d4 dxe4 7.Nxe4 Qxd4 8.Bd3 Nd7 9.Be3 Qd5 10.O-O Ne5 11.Qg3 Nxd3 12.cxd3 Nf6 13.Bg5 Be7 14.Bxf6 Bxf6 15.Qc7 Qd7 16.Nd6+ Ke7 17.Nf5+ Ke8 18.Nd6+ Ke7 19.Nf5+ Ke8"
  }
]
```
