# GET /api/annotations/games

Fetches all annotated games in [data/annotations/games.json](https://github.com/chesslablab/chess-api/blob/main/data/annotations/games.json).

## Example

`curl https://pchess.net/api/annotations/games`.

`{
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
  }`
