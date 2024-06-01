# POST /v1/tutor/fen

Explains a FEN position in terms of chess concepts.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| fen | A FEN string. | Yes |

## Example

```text
curl --request POST \
  --url https://api.chesslablab.org/v1/tutor/fen \
  --data '{"fen":"r1bq1rk1/pppnn1bp/3p2p1/3Ppp2/2P1P3/2N2P2/PP2B1PP/R1BQNRK1 w - f6"}'
```

```text
"White is totally controlling the center. The white pieces are significantly better connected. White has a moderate space advantage. The black player is pressuring a little bit more squares than its opponent. White has a slight advanced pawn advantage. d5 is an advanced pawn. e6 and d4 are outpost squares. Overall, 4 heuristic evaluation features are favoring White while 1 is favoring Black."
```
