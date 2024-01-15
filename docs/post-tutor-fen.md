# POST /tutor/fen

Explains a FEN position in terms of chess concepts like a tutor would do.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| variant | Accepts: 960, capablanca, capablanca-fischer, classical. | Yes |
| fen | Initial FEN string. | Yes |
| startPos | Start position. | Only in a Chess960 game. |

### Example

```text
curl https://chesslablab.net/api/tutor/fen \
  -H "Content-Type: application/json" \
  --data-raw '{
    "variant": "classical",
  	"fen": "rnb1kbnr/ppppqppp/8/4p3/4PP2/6P1/PPPP3P/RNBQKBNR w KQkq -"
  }'
```

```text
{
  "explanation": "Black has a somewhat better control of the center. The black pieces are significantly better connected. White has a kind of space advantage."
}
```
