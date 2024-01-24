# POST /download/mp4

Downloads a video.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| variant | Accepts: 960, capablanca, capablanca-fischer, classical. | Yes |
| fen | A FEN string. | No |
| movetext | A portable game notation (PGN) movetext. | Yes |
| startPos | Start position. | Only in a Chess960 game. |
| flip | Accepts: w, b. | Yes |

## Example

Downloads a classical game from the start position.

```text
curl https://api.chesslablab.net/v1/download/mp4 \
  -H "Content-Type: application/json" \
  --data-raw '{
    "variant": "classical",
    "movetext": "1.d4 Nf6 2.c4 g6 3.Nc3 Bg7 4.e4 d6",
    "flip": "b"
  }' \
  --output video.mp4
```
