# GET /stats/opening

Returns statistics about the chess openings available in the database: Draw rate, win rate for White and win rate for Black.

## Example

```text
curl https://pchess.net/api/stats/opening
```

```text
{
  "drawRate": [
    {
      "ECO": "C42",
      "total": 2964
    },
    ...
    {
      "ECO": "B23",
      "total": 1044
    }
  ],
  "winRateForWhite": [
    {
      "ECO": "A45",
      "total": 2880
    },
    ...
    {
      "ECO": "B51",
      "total": 1053
    }
  ],
  "winRateForBlack": [
    {
      "ECO": "A45",
      "total": 2658
    },
    ...
    {
      "ECO": "D10",
      "total": 732
    }
  ]
}
```
