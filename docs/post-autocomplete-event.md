# POST /v1/autocomplete/event

Returns autocomplete data for chess events.

## `Event`

The name of the event.

---

```text
curl https://api.chesslablab.org:9443/v1/autocomplete/event \
  -H "Content-Type: application/json" \
  --data-raw '{
    "Event": "candidates"
  }'
```

```text
[
	"FIDE Candidates 2014",
	"FIDE Candidates 2016",
	"WCh Candidates s\/f",
	"FIDE Candidates",
	"FIDE Candidates (Women)",
	"FIDE Women's Candidates",
	"Women Candidates Pool B",
	"WCh Candidates",
	"FIDE Candidates 2018"
]
```
