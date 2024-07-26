# POST /v1/autocomplete/player

Returns autocomplete data for chess players.

## `White` (optional)

The name of the player with the white pieces.

## `Black` (optional)

The name of the player with the black pieces.

---

```text
curl https://api.chesslablab.org:9443/v1/autocomplete/player \
  -H "Content-Type: application/json" \
  --data-raw '{
    "White": "anand"
  }'
```

```text
[
  "Anand, Viswanathan",
  "Anand,V",
  "Anand,V \/ FRITZ7",
  "Praggnanandhaa,R",
  "Anand,Vignesh",
  "Pranav,Anand"
]
```
