# POST /v1/autocomplete/player

Returns autocomplete data for chess players.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| White | The name of the player with the white pieces. | No |
| Black | The name of the player with the black pieces. | No |

## Example

```text
curl https://api.chesslablab.org/v1/autocomplete/player \
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
