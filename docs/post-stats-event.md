# POST /stats/event

Returns statistics about opening results in chess events.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| Event | The name of the event. | No |
| Result | Accepts: 1-0, 0-1, 1/2-1/2. | No |

## Example

```text
curl https://chesslablab.net/api/stats/event \
  -H "Content-Type: application/json" \
  --data-raw '{
    "Event": "FIDE Candidates 2022",
    "Result": "0-1"
  }'
```

```text
[
	{
		"ECO": "C42",
		"total": 2
	},
	{
		"ECO": "C65",
		"total": 2
	},
    ...
	{
		"ECO": "A20",
		"total": 1
	},
	{
		"ECO": "E06",
		"total": 1
	}
]
```
