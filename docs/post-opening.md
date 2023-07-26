# POST /opening

Finds up to 25 chess openings matching the criteria.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| eco | Encyclopaedia of Chess Openings (ECO) code. | No |
| name | Opening name. | No |
| movetext | Opening moves. | No |

## Example

```text
curl https://pchess.net/api/opening \
  -H "Content-Type: application/json" \
  --data-raw '{
    "eco": "B90"
  }'
```

```text
[
  {
    "id": 4820,
    "eco": "B90",
    "name": "Sicilian Defense: Scheveningen Variation, English Attack",
    "movetext": "1.e4 c5 2.Nf3 d6 3.d4 cxd4 4.Nxd4 Nf6 5.Nc3 a6 6.Be3 e6 7.f3"
  },
  {
    "id": 4813,
    "eco": "B90",
    "name": "Sicilian Defense: Najdorf Variation, Dekker Gambit",
    "movetext": "1.e4 c5 2.Nf3 d6 3.d4 cxd4 4.Nxd4 Nf6 5.Nc3 a6 6.g4"
  },
  {
    "id": 4815,
    "eco": "B90",
    "name": "Sicilian Defense: Najdorf Variation, English Attack, Anti-English",
    "movetext": "1.e4 c5 2.Nf3 d6 3.d4 cxd4 4.Nxd4 Nf6 5.Nc3 a6 6.Be3 Ng4"
  },
  {
    "id": 4816,
    "eco": "B90",
    "name": "Sicilian Defense: Najdorf Variation, Freak Attack",
    "movetext": "1.e4 c5 2.Nf3 d6 3.d4 cxd4 4.Nxd4 Nf6 5.Nc3 a6 6.Rg1"
  },
  {
    "id": 4814,
    "eco": "B90",
    "name": "Sicilian Defense: Najdorf Variation, English Attack",
    "movetext": "1.e4 c5 2.Nf3 d6 3.d4 cxd4 4.Nxd4 Nf6 5.Nc3 a6 6.Be3"
  },
  {
    "id": 4812,
    "eco": "B90",
    "name": "Sicilian Defense: Najdorf Variation, Adams Attack",
    "movetext": "1.e4 c5 2.Nf3 d6 3.d4 cxd4 4.Nxd4 Nf6 5.Nc3 a6 6.h3"
  },
  {
    "id": 4818,
    "eco": "B90",
    "name": "Sicilian Defense: Scheveningen Variation, Delayed Keres Attack",
    "movetext": "1.e4 c5 2.Nf3 d6 3.d4 cxd4 4.Nxd4 Nf6 5.Nc3 a6 6.Be3 e6 7.g4"
  },
  {
    "id": 4811,
    "eco": "B90",
    "name": "Sicilian Defense: Najdorf Variation",
    "movetext": "1.e4 c5 2.Nf3 d6 3.d4 cxd4 4.Nxd4 Nf6 5.Nc3 a6"
  },
  {
    "id": 4819,
    "eco": "B90",
    "name": "Sicilian Defense: Scheveningen Variation, Delayed Keres Attack, Perenyi Gambit",
    "movetext": "1.e4 c5 2.Nf3 d6 3.d4 cxd4 4.Nxd4 Nf6 5.Nc3 a6 6.Be3 e6 7.g4 e5 8.Nf5 g6 9.g5"
  },
  {
    "id": 4817,
    "eco": "B90",
    "name": "Sicilian Defense: Najdorf Variation, Lipnitsky Attack",
    "movetext": "1.e4 c5 2.Nf3 d6 3.d4 cxd4 4.Nxd4 Nf6 5.Nc3 a6 6.Bc4"
  }
]
```
