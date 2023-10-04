# POST /download/image

Downloads an image.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| variant | Accepts: 960, capablanca, capablanca-fischer, classical. | Yes |
| fen | A FEN string. | Yes |
| flip | Accepts: w, b. | Yes |

## Example

```text
curl https://pchess.net/api/download/image \
  -H "Content-Type: application/json" \
  --data-raw '{
    "variant": "classical",
    "fen": "r1bq1rk1/pppnn1bp/3p2p1/3Ppp2/2P1P3/2N2P2/PP2B1PP/R1BQNRK1 w - f6",
    "flip": "w"
  }' \
  --output image.png
```

![Figure 1](https://raw.githubusercontent.com/chesslablab/chess-api/master/docs/post-download-image_01.png)
