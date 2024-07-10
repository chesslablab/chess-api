# POST /v1/autocomplete/event

Returns autocomplete data for chess events.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| Event | The name of the event. | Yes |

## Example

```text
curl https://api.chesslablab.org/v1/autocomplete/event \
  -H "Content-Type: application/json" \
  --data-raw '{
    "Event": "FIDE"
  }'
```

```text
[
  "Candidats FIDE sf1",
  "Candidats FIDE sf1 playoff rapid",
  "Candidats FIDE m2",
  "FIDE-Wch k.o.",
  "FIDE-Wch k.o. f",
  "FIDE-Wch k.o. f 25\u0027",
  "FIDE World Cup Gp D",
  "FIDE World Cup KO",
  "FIDE WCh KO",
  "FIDE GP"
]
```
