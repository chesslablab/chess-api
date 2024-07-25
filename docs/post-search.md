# POST /v1/search

Finds up to 25 games matching the criteria.

## `Event` (optional)

The name of the event.

## `Date` (optional)

The year in which the event took place.

## `White` (optional)

The player with the white pieces.

## `Black` (optional)

The player with the black pieces.

## `Result` (optional)

The result of the game as per these options.

- `1-0` means White wins.
- `1/2-1/2` means the game is a draw.
- `0-1` means Black wins.

## `ECO` (optional)

Encyclopaedia of Chess Openings (ECO) code.

---

```text
curl https://api.chesslablab.org/v1/search \
  -H "Content-Type: application/json" \
  --data-raw '{
    "Black": "Kasparov,G",
    "ECO": "D37"
  }'
```

```text
[
  {
    "id": 156639,
    "Event": "Rapid",
    "Site": "Reykjavik ISL",
    "Date": "2004.03.20",
    "White": "Nielsen,PH",
    "Black": "Kasparov,G",
    "Result": "1\/2-1\/2",
    "WhiteElo": "2638",
    "BlackElo": "2831",
    "ECO": "D37",
    "FEN": null,
    "movetext": "1.d4 Nf6 2.c4 e6 3.Nf3 d5 4.Nc3 Be7 5.Bf4 O-O 6.e3 c5 7.dxc5 Bxc5 8.a3 Nc6 9.Rc1 a6 10.b4 Bd6 11.Bg5 a5 12.b5 Ne7 13.Bxf6 gxf6 14.a4 Bb4 15.Be2 dxc4 16.O-O Nd5 17.Na2 Nb6 18.Qc2 e5 19.Nxb4 axb4 20.Bxc4 Nxc4 21.Qxc4 Rxa4 22.Rfd1 Qb6 23.Nh4 Be6 24.Qe4 Qxb5 25.Qf3 Kg7 26.Nf5+ Bxf5 27.Qxf5 b3 28.Rd6 b2 29.Qxf6+ Kg8 30.Qg5+ Kh8 31.Qf6+"
  },
  {
    "id": 369145,
    "Event": "Corus",
    "Site": "Wijk aan Zee NED",
    "Date": "2001.01.27",
    "White": "Van Wely,L",
    "Black": "Kasparov,G",
    "Result": "1\/2-1\/2",
    "WhiteElo": "2700",
    "BlackElo": "2849",
    "ECO": "D37",
    "FEN": null,
    "movetext": "1.d4 Nf6 2.c4 e6 3.Nf3 d5 4.Nc3 Be7 5.Bf4 O-O 6.e3 c5 7.dxc5 Bxc5 8.cxd5 Nxd5 9.Nxd5 exd5 10.a3 Nc6 11.Bd3 Bb6 12.O-O Bg4 13.h3 Bh5 14.b4 Re8 15.Rc1 a6 16.g4 Bg6 17.Bxg6 hxg6 18.Rc3 d4 19.Rd3 Qd5 20.exd4 Re4 21.Be3 Rd8 22.Re1 f6 23.Kg2 f5 24.gxf5 gxf5 25.Qb3 Qxb3 26.Rxb3 f4 27.d5 fxe3 28.dxc6 Re6 29.fxe3 Rxc6 30.Kf2 Rf8 31.Ke2 Rc2+ 32.Nd2 Rd8 33.Rd3 Ra2 34.Rxd8+ Bxd8 35.Rc1 Bf6 36.Rc7 b5 37.Rc6 Rxa3 38.Ne4 Be7 39.Nc5 a5 40.Rb6 axb4 41.Rxb5 Ra2+ 42.Kd3 Rh2 43.Na6"
  },
  {
    "id": 332967,
    "Event": "Corus",
    "Site": "Wijk aan Zee NED",
    "Date": "2001.01.27",
    "White": "Van Wely,L",
    "Black": "Kasparov,G",
    "Result": "1\/2-1\/2",
    "WhiteElo": "2700",
    "BlackElo": "2849",
    "ECO": "D37",
    "FEN": null,
    "movetext": "1.d4 Nf6 2.c4 e6 3.Nf3 d5 4.Nc3 Be7 5.Bf4 O-O 6.e3 c5 7.dxc5 Bxc5 8.cxd5 Nxd5 9.Nxd5 exd5 10.a3 Nc6 11.Bd3 Bb6 12.O-O Bg4 13.h3 Bh5 14.b4 Re8 15.Rc1 a6 16.g4 Bg6 17.Bxg6 hxg6 18.Rc3 d4 19.Rd3 Qd5 20.exd4 Re4 21.Be3 Rd8 22.Re1 f6 23.Kg2 f5 24.gxf5 gxf5 25.Qb3 Qxb3 26.Rxb3 f4 27.d5 fxe3 28.dxc6 Re6 29.fxe3 Rxc6 30.Kf2 Rf8 31.Ke2 Rc2+ 32.Nd2 Rd8 33.Rd3 Ra2 34.Rxd8+ Bxd8 35.Rc1 Bf6 36.Rc7 b5 37.Rc6 Rxa3 38.Ne4 Be7 39.Nc5 a5 40.Rb6 axb4 41.Rxb5 Ra2+ 42.Kd3 Rh2 43.Na6"
  },
  {
    "id": 369372,
    "Event": "Rapid",
    "Site": "Reykjavik ISL",
    "Date": "2004.03.20",
    "White": "Nielsen,PH",
    "Black": "Kasparov,G",
    "Result": "1\/2-1\/2",
    "WhiteElo": "2638",
    "BlackElo": "2831",
    "ECO": "D37",
    "FEN": null,
    "movetext": "1.d4 Nf6 2.c4 e6 3.Nf3 d5 4.Nc3 Be7 5.Bf4 O-O 6.e3 c5 7.dxc5 Bxc5 8.a3 Nc6 9.Rc1 a6 10.b4 Bd6 11.Bg5 a5 12.b5 Ne7 13.Bxf6 gxf6 14.a4 Bb4 15.Be2 dxc4 16.O-O Nd5 17.Na2 Nb6 18.Qc2 e5 19.Nxb4 axb4 20.Bxc4 Nxc4 21.Qxc4 Rxa4 22.Rfd1 Qb6 23.Nh4 Be6 24.Qe4 Qxb5 25.Qf3 Kg7 26.Nf5+ Bxf5 27.Qxf5 b3 28.Rd6 b2 29.Qxf6+ Kg8 30.Qg5+ Kh8 31.Qf6+"
  }
]
```
