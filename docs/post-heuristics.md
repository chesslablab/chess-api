# POST /v1/heuristics

Returns the heuristics of a chess game. A chess game can be plotted in terms of balance. +1 is the best possible evaluation for White and -1 the best possible evaluation for Black. Both forces being set to 0 means they're balanced.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| variant | Accepts: 960, capablanca, capablanca-fischer, classical. | Yes |
| movetext | A portable game notation (PGN) movetext. | Yes |
| fen | Initial FEN string. | No |
| startPos | Start position. | Only in a Chess960 game. |

### Example

```text
curl https://api.chesslablab.org/v1/heuristics \
  -H "Content-Type: application/json" \
  --data-raw '{
    "variant": "classical",
    "movetext": "1.d4 Nf6 2.c4 e6 3.Nf3 b6 4.Nc3"
  }'
```

```text
{
	"names": [
		"Center",
		"Space"
	],
	"balance": [
		[
			0,
			0.89,
			-1,
			0.45,
			0.05,
			0.4,
			0.4,
			1
		],
		[
			0,
			1,
			0.33,
			1,
			0.33,
			0.5,
			0.33,
			0.5
		]
	]
}
```
