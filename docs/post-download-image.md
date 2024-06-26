# POST /v1/download/image

Downloads an image.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| fen | A FEN string. | Yes |
| flip | Accepts: w, b. | Yes |

## Example

```text
curl https://api.chesslablab.org/v1/download/image \
  -H "Content-Type: application/json" \
  --data-raw '{
    "fen": "r1bq1rk1/pppnn1bp/3p2p1/3Ppp2/2P1P3/2N2P2/PP2B1PP/R1BQNRK1 w - f6",
    "flip": "w"
  }' \
  --output image.png
```

![Figure 1](https://raw.githubusercontent.com/chesslablab/chess-api/master/docs/post-download-image_01.png)
