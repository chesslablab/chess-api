# GET /v1/annotations/games

Returns the annotated chess games available in the database.

---

```text
curl https://api.chesslablab.org:9443/v1/annotations/games
```

```text
[
  {
    "Event": "Steinitz - Zukertort World Championship Match",
    "Site": "New Orleans, LA USA",
    "Date": "1886",
    "White": "Johannes Zukertort",
    "Black": "Wilhelm Steinitz",
    "WhiteElo": "?",
    "BlackElo": "?",
    "Result": "0-1",
    "ECO": "D50",
    "movetext": "{ The Queen's Gambit Declined. Adapted notes originally by Robert James Fischer from a television interview. } 1.d4 d5 2.c4 e6 3.Nc3 Nf6 4.Bg5 Be7 5.Nf3 O-O 6.c5 { is a mistake already; instead it should be played e3, naturally. } 6...b6 7.b4 bxc5 8.dxc5 a5 9.a3 d4 { is a fantastic move; it's the winning move. The pawn can't be taken with the knight because of axb4. } 10.Bxf6 gxf6 11.Na4 e5 { because the center is easily winning. Black's kingside weakness is nothing. } 12.b5 Be6 { with the idea of dominating the game with a powerful mobile center. } 13.g3 c6 14.bxc6 Nxc6 15.Bg2 Rb8 { threatening Bb3. } 16.Qc1 d3 17.e3 e4 18.Nd2 f5 19.O-O Re8 { is a very modern move; a quiet positional move. The rook is doing nothing now, but later... } 20.f3 { to break up the center, it's the only chance for White. } 20...Nd4 21.exd4 Qxd4+ 22.Kh1 e3 (22... Qxa4 { allows Black to easily regain material. }) 23.Nc3 Bf6 24.Ndb1 d2 25.Qc2 Bb3 26.Qxf5 d1=Q 27.Nxd1 Bxd1 28.Nc3 e2 29.Raxd1 Qxc3 { and White resigns. The center has prevailed. } 0-1"
  },
  ...
  {
    "Event": "Lasker - Capablanca World Championship Match (1)",
    "Site": "Havana CUB",
    "Date": "1921",
    "White": "Jose Raul Capablanca",
    "Black": "Emanuel Lasker",
    "WhiteElo": "?",
    "BlackElo": "?",
    "Result": "1/2-1/2",
    "ECO": "D02",
    "movetext": "{Queen's Pawn Game. Adapted notes originally by J. R. Capablanca.} 1.d4 d5 2.Nf3 e6 3.c4 Nf6 4.Bg5 Be7 5.e3 Nbd7 6.Nc3 O-O 7.Rc1 b6 8.cxd5 exd5 9.Bb5 {is a new move which has no merit outside of its novelty. I played it for the first time against Teichmann in Berlin in 1913. } (9.Bd3 { is the normal move but Qa4 may be the best, after all. }) 9...Bb7 10.Qa4 a6 (10...c5 { is the proper continuation.}) 11.Bxd7 Nxd7 12.Bxe7 Qxe7 13.Qb3 { with the idea of preventing c5, but still better would have been to castle.} Qd6 (13...c5 { could be played as well. Black would come out all right from the many complications arising from this move.}) 14.O-O Rfd8 15.Rfd1 Rab8 16.Ne1 { in order to draw the knight away from the line of the bishop, which would soon be open, as it actually occurred in the game.} Nf6 17.Rc2 c5 18.dxc5 bxc5 19.Ne2 Ne4 (19...Ng4 { begins a failed attack. }) (19...d4 { begins a failed attack. }) 20.Qa3 Rbc8 21.Ng3 Nxg3 22.hxg3 Qb6 23.Rcd2 (23.Rdc1 { would not have been better because of d4, etc. } d4) 23...h6 24.Nf3 d4 25.exd4 Bxf3 26.Qxf3 Rxd4 27.Rc2 Rxd1+ 28.Qxd1 Rd8 29.Qe2 Qd6 30.Kh2 Qd5 31.b3 Qf5 32.g4 Qg5 33.g3 Rd6 { is unquestionably the best move; with any other move Black would, perhaps, have found it impossible to draw.} 34.Kg2 g6 35.Qc4 Re6 36.Qxc5 Qxg4 37.f3 Qg5 38.Qxg5 hxg5 39.Kf2 Rd6 40.Ke3 Re6+ 41.Kd4 Rd6+ (42.Kc5 { is too risky. The way to win was not at all clear and I even thought that with that move Black might win. }) 42.Ke3 Re6+ 43.Kf2 Rd6 44.g4 Rd1 (45.Ke3 { is the right move to make. It is perhaps the only chance White has to win, or at least come near it. } Ra1 46.Kd4 { gains an important move. } Kg7 47.b4 Rf1 { accomplishes nothing with the white king on d4. }) 45.Ke2 { was played instead. } Ra1 46.Kd3 Kg7 47.b4 Rf1 { was the best move with the white king on d3. } 48.Ke3 { and the remainder of the game needs no comments. } Rb1 49.Rc6 Rxb4 50.Rxa6 Rb2 1/2-1/2"
  }
]
```
