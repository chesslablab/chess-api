# POST /v1/stats/player

Returns statistics about opening results by chess player.

## `White` (optional)

The player with the white pieces.

## `Black` (optional)

The player with the black pieces.

## `Result` (optional)

The result of the game as per these options.

- `1-0` means White wins.
- `1/2-1/2` means the game is a draw.
- `0-1` means Black wins.

---

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
