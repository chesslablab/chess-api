# POST /v1/stats/event

Returns statistics about opening results in chess events.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| Event | The name of the event. | No |
| Result | Accepts: 1-0, 0-1, 1/2-1/2. | No |

## Example

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
