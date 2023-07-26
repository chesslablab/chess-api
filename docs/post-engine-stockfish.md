# POST /engine/stockfish

Returns Stockfish's move in LAN format.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| movetext | A long algebraic notation (LAN) movetext. | Yes |
| skillLevel | Accepts an integer value between 0 and 20.. | Yes |
| depth | Accepts an integer value between 1 and 15. | Yes |

## Example

```text
curl https://pchess.net/api/engine/stockfish \
  -H "Content-Type: application/json" \
  --data-raw '{
    "movetext": "e2e4 e7e5",
    "skillLevel": "9",
    "depth": "3"
  }'
```

```text
{
  "move": "b1c3",
  "fen": "rnbqkbnr/pppp1ppp/8/4p3/4P3/2N5/PPPP1PPP/R1BQKBNR b KQkq -",
  "isCheck": false,
  "isMate": false,
  "movetext": "1.e4 e5 2.Nc3"
}
```
