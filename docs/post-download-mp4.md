# POST /v1/download/mp4

Downloads a video.

## `variant`

The chess variant as per these options.

- `classical` chess, also known as standard or slow chess.
- `960` is the same as classical chess except that the starting position of the pieces is randomized.
- `dunsany` is an asymmetric variant in which Black has the standard chess army and White has 32 pawns.
- `losing` chess, the objective of each player is to lose all of their pieces or be stalemated.
- `racing-kings` consists of being the first player to move their king to the eighth row.

## `movetext`

A portable game notation (PGN) movetext.

## `flip`

The orientation of the board as per these options.

- `w` for White's perspective.
- `b` for Black's perspective.

## `fen` (optional)

A FEN string.

## `startPos` (optional)

The start position in a Chess960 game; for example `BRNNKBRQ`.

---

```text
curl https://api.chesslablab.org:9443/v1/download/mp4 \
  -H "Content-Type: application/json" \
  --data-raw '{
    "variant": "classical",
    "movetext": "1.d4 Nf6 2.c4 g6 3.Nc3 Bg7 4.e4 d6",
    "flip": "b"
  }' \
  --output video.mp4
```
