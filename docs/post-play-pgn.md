# POST /play/pgn

Plays chess in portable game notation (PGN) format.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| variant | Accepts: 960, capablanca, classical. | Yes |
| startPos | Start position. | Only in a Chess960 game. |
| movetext | A portable game notation (PGN) movetext. | Yes |

## Example

```text
curl https://pchess.net/api/play/pgn \
  -H "Content-Type: application/json" \
  --data-raw '{
    "variant": "960",
    "startPos": "RQKBBNNR",
    "movetext": "1.e4 e5"
  }'
```

```text
{
  "fen": "rqkbbnnr/pppp1ppp/8/4p3/4P3/8/PPPP1PPP/RQKBBNNR w KQkq e6",
  "isCheck": false,
  "isMate": false,
  "movetext": "1.e4 e5"
}
```
