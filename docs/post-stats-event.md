# POST /v1/stats/event

Returns statistics about opening results in chess events.

## `Event` (optional)

The name of the event.

## `Result` (optional)

The result of the game as per these options.

- `1-0` means White wins.
- `1/2-1/2` means the game is a draw.
- `0-1` means Black wins.

---

```text
curl https://api.chesslablab.org/v1/stats/event \
  -H "Content-Type: application/json" \
  --data-raw '{
    "Event": "FIDE Candidates 2018",
    "Result": "1-0"
  }'
```

```text
[
	{
		"ECO": "D35",
		"total": 2
	},
	{
		"ECO": "A48",
		"total": 1
	},
	{
		"ECO": "D40",
		"total": 1
	},
	{
		"ECO": "C50",
		"total": 1
	}
]
```
