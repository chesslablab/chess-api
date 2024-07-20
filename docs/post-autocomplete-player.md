# POST /v1/autocomplete/player

Returns autocomplete data for chess players.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| White | The name of the player. | Conditional* |
| Black | The name of the player. | Conditional* |

***One of the parameters (`White` or `Black`) is required**

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
	"Anand,V / FRITZ7",
	"Praggnanandhaa,R",
	"Anand,Vignesh",
	"Pranav,Anand"
]
```
