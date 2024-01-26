# POST /v1/stats/player

Returns statistics about opening results by chess player.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| White | The player with the white pieces. | No |
| Black | The player with the black pieces. | No |
| Result | Accepts: 1-0, 0-1, 1/2-1/2. | No |

## Example

```text
curl https://api.chesslablab.org/v1/stats/player \
  -H "Content-Type: application/json" \
  --data-raw '{
    "Result": "0-1"
  }'
```

```text
[
  {
    "ECO": "B06",
    "total": 39
  },
  {
    "ECO": "A46",
    "total": 34
  },
  ...
  {
    "ECO": "C40",
    "total": 1
  },
  {
    "ECO": "C98",
    "total": 1
  }
]
```
