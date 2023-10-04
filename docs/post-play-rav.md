# POST /play/rav

Plays the moves in a RAV movetext returning the sequence of FEN positions that make up such movetext.

## Parameters

| Name | Description | Required |
| ---- | ----------- | -------- |
| movetext | A portable game notation (PGN) movetext. | Yes |
| variant | Accepts: 960, capablanca, capablanca-fischer, classical. | Yes |
| fen | Initial FEN string. | No |
| startPos | Start position. | Only in a Chess960 game. |

## Example

```text
curl https://pchess.net/api/play/rav \
  -H "Content-Type: application/json" \
  --data-raw '{
    "movetext": "1.d4 Nf6 2.c4 e6 3.Nf3 d5 4.Nc3 Be7 5.Bf4 O-O 6.e3 c5 7.dxc5 Bxc5 8.a3 Nc6 9.Rc1 a6 10.b4 Bd6 11.Bg5 a5 12.b5 Ne7 13.Bxf6 gxf6 14.a4 Bb4 15.Be2 dxc4 16.O-O Nd5 17.Na2 Nb6 18.Qc2 e5 19.Nxb4 axb4 20.Bxc4 Nxc4 21.Qxc4 Rxa4 22.Rfd1 Qb6 23.Nh4 Be6 24.Qe4 Qxb5 25.Qf3 Kg7 26.Nf5+ Bxf5 27.Qxf5 b3 28.Rd6 b2 29.Qxf6+ Kg8 30.Qg5+ Kh8 31.Qf6+",
    "variant": "classical"
  }'
```

```text
{
  "variant": "classical",
  "turn": "b",
  "filtered": "1.d4 Nf6 2.c4 e6 3.Nf3 d5 4.Nc3 Be7 5.Bf4 O-O 6.e3 c5 7.dxc5 Bxc5 8.a3 Nc6 9.Rc1 a6 10.b4 Bd6 11.Bg5 a5 12.b5 Ne7 13.Bxf6 gxf6 14.a4 Bb4 15.Be2 dxc4 16.O-O Nd5 17.Na2 Nb6 18.Qc2 e5 19.Nxb4 axb4 20.Bxc4 Nxc4 21.Qxc4 Rxa4 22.Rfd1 Qb6 23.Nh4 Be6 24.Qe4 Qxb5 25.Qf3 Kg7 26.Nf5+ Bxf5 27.Qxf5 b3 28.Rd6 b2 29.Qxf6+ Kg8 30.Qg5+ Kh8 31.Qf6+",
  "movetext": "1.d4 Nf6 2.c4 e6 3.Nf3 d5 4.Nc3 Be7 5.Bf4 O-O 6.e3 c5 7.dxc5 Bxc5 8.a3 Nc6 9.Rc1 a6 10.b4 Bd6 11.Bg5 a5 12.b5 Ne7 13.Bxf6 gxf6 14.a4 Bb4 15.Be2 dxc4 16.O-O Nd5 17.Na2 Nb6 18.Qc2 e5 19.Nxb4 axb4 20.Bxc4 Nxc4 21.Qxc4 Rxa4 22.Rfd1 Qb6 23.Nh4 Be6 24.Qe4 Qxb5 25.Qf3 Kg7 26.Nf5+ Bxf5 27.Qxf5 b3 28.Rd6 b2 29.Qxf6+ Kg8 30.Qg5+ Kh8 31.Qf6+",
  "breakdown": [
    "1.d4 Nf6 2.c4 e6 3.Nf3 d5 4.Nc3 Be7 5.Bf4 O-O 6.e3 c5 7.dxc5 Bxc5 8.a3 Nc6 9.Rc1 a6 10.b4 Bd6 11.Bg5 a5 12.b5 Ne7 13.Bxf6 gxf6 14.a4 Bb4 15.Be2 dxc4 16.O-O Nd5 17.Na2 Nb6 18.Qc2 e5 19.Nxb4 axb4 20.Bxc4 Nxc4 21.Qxc4 Rxa4 22.Rfd1 Qb6 23.Nh4 Be6 24.Qe4 Qxb5 25.Qf3 Kg7 26.Nf5+ Bxf5 27.Qxf5 b3 28.Rd6 b2 29.Qxf6+ Kg8 30.Qg5+ Kh8 31.Qf6+"
  ],
  "fen": [
    "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq -",
    "rnbqkbnr/pppppppp/8/8/3P4/8/PPP1PPPP/RNBQKBNR b KQkq d3",
    "rnbqkb1r/pppppppp/5n2/8/3P4/8/PPP1PPPP/RNBQKBNR w KQkq -",
    "rnbqkb1r/pppppppp/5n2/8/2PP4/8/PP2PPPP/RNBQKBNR b KQkq c3",
    "rnbqkb1r/pppp1ppp/4pn2/8/2PP4/8/PP2PPPP/RNBQKBNR w KQkq -",
    "rnbqkb1r/pppp1ppp/4pn2/8/2PP4/5N2/PP2PPPP/RNBQKB1R b KQkq -",
    "rnbqkb1r/ppp2ppp/4pn2/3p4/2PP4/5N2/PP2PPPP/RNBQKB1R w KQkq d6",
    "rnbqkb1r/ppp2ppp/4pn2/3p4/2PP4/2N2N2/PP2PPPP/R1BQKB1R b KQkq -",
    "rnbqk2r/ppp1bppp/4pn2/3p4/2PP4/2N2N2/PP2PPPP/R1BQKB1R w KQkq -",
    "rnbqk2r/ppp1bppp/4pn2/3p4/2PP1B2/2N2N2/PP2PPPP/R2QKB1R b KQkq -",
    "rnbq1rk1/ppp1bppp/4pn2/3p4/2PP1B2/2N2N2/PP2PPPP/R2QKB1R w KQ -",
    "rnbq1rk1/ppp1bppp/4pn2/3p4/2PP1B2/2N1PN2/PP3PPP/R2QKB1R b KQ -",
    "rnbq1rk1/pp2bppp/4pn2/2pp4/2PP1B2/2N1PN2/PP3PPP/R2QKB1R w KQ c6",
    "rnbq1rk1/pp2bppp/4pn2/2Pp4/2P2B2/2N1PN2/PP3PPP/R2QKB1R b KQ -",
    "rnbq1rk1/pp3ppp/4pn2/2bp4/2P2B2/2N1PN2/PP3PPP/R2QKB1R w KQ -",
    "rnbq1rk1/pp3ppp/4pn2/2bp4/2P2B2/P1N1PN2/1P3PPP/R2QKB1R b KQ -",
    "r1bq1rk1/pp3ppp/2n1pn2/2bp4/2P2B2/P1N1PN2/1P3PPP/R2QKB1R w KQ -",
    "r1bq1rk1/pp3ppp/2n1pn2/2bp4/2P2B2/P1N1PN2/1P3PPP/2RQKB1R b K -",
    "r1bq1rk1/1p3ppp/p1n1pn2/2bp4/2P2B2/P1N1PN2/1P3PPP/2RQKB1R w K -",
    "r1bq1rk1/1p3ppp/p1n1pn2/2bp4/1PP2B2/P1N1PN2/5PPP/2RQKB1R b K b3",
    "r1bq1rk1/1p3ppp/p1nbpn2/3p4/1PP2B2/P1N1PN2/5PPP/2RQKB1R w K -",
    "r1bq1rk1/1p3ppp/p1nbpn2/3p2B1/1PP5/P1N1PN2/5PPP/2RQKB1R b K -",
    "r1bq1rk1/1p3ppp/2nbpn2/p2p2B1/1PP5/P1N1PN2/5PPP/2RQKB1R w K -",
    "r1bq1rk1/1p3ppp/2nbpn2/pP1p2B1/2P5/P1N1PN2/5PPP/2RQKB1R b K -",
    "r1bq1rk1/1p2nppp/3bpn2/pP1p2B1/2P5/P1N1PN2/5PPP/2RQKB1R w K -",
    "r1bq1rk1/1p2nppp/3bpB2/pP1p4/2P5/P1N1PN2/5PPP/2RQKB1R b K -",
    "r1bq1rk1/1p2np1p/3bpp2/pP1p4/2P5/P1N1PN2/5PPP/2RQKB1R w K -",
    "r1bq1rk1/1p2np1p/3bpp2/pP1p4/P1P5/2N1PN2/5PPP/2RQKB1R b K -",
    "r1bq1rk1/1p2np1p/4pp2/pP1p4/PbP5/2N1PN2/5PPP/2RQKB1R w K -",
    "r1bq1rk1/1p2np1p/4pp2/pP1p4/PbP5/2N1PN2/4BPPP/2RQK2R b K -",
    "r1bq1rk1/1p2np1p/4pp2/pP6/Pbp5/2N1PN2/4BPPP/2RQK2R w K -",
    "r1bq1rk1/1p2np1p/4pp2/pP6/Pbp5/2N1PN2/4BPPP/2RQ1RK1 b - -",
    "r1bq1rk1/1p3p1p/4pp2/pP1n4/Pbp5/2N1PN2/4BPPP/2RQ1RK1 w - -",
    "r1bq1rk1/1p3p1p/4pp2/pP1n4/Pbp5/4PN2/N3BPPP/2RQ1RK1 b - -",
    "r1bq1rk1/1p3p1p/1n2pp2/pP6/Pbp5/4PN2/N3BPPP/2RQ1RK1 w - -",
    "r1bq1rk1/1p3p1p/1n2pp2/pP6/Pbp5/4PN2/N1Q1BPPP/2R2RK1 b - -",
    "r1bq1rk1/1p3p1p/1n3p2/pP2p3/Pbp5/4PN2/N1Q1BPPP/2R2RK1 w - -",
    "r1bq1rk1/1p3p1p/1n3p2/pP2p3/PNp5/4PN2/2Q1BPPP/2R2RK1 b - -",
    "r1bq1rk1/1p3p1p/1n3p2/1P2p3/Ppp5/4PN2/2Q1BPPP/2R2RK1 w - -",
    "r1bq1rk1/1p3p1p/1n3p2/1P2p3/PpB5/4PN2/2Q2PPP/2R2RK1 b - -",
    "r1bq1rk1/1p3p1p/5p2/1P2p3/Ppn5/4PN2/2Q2PPP/2R2RK1 w - -",
    "r1bq1rk1/1p3p1p/5p2/1P2p3/PpQ5/4PN2/5PPP/2R2RK1 b - -",
    "2bq1rk1/1p3p1p/5p2/1P2p3/rpQ5/4PN2/5PPP/2R2RK1 w - -",
    "2bq1rk1/1p3p1p/5p2/1P2p3/rpQ5/4PN2/5PPP/2RR2K1 b - -",
    "2b2rk1/1p3p1p/1q3p2/1P2p3/rpQ5/4PN2/5PPP/2RR2K1 w - -",
    "2b2rk1/1p3p1p/1q3p2/1P2p3/rpQ4N/4P3/5PPP/2RR2K1 b - -",
    "5rk1/1p3p1p/1q2bp2/1P2p3/rpQ4N/4P3/5PPP/2RR2K1 w - -",
    "5rk1/1p3p1p/1q2bp2/1P2p3/rp2Q2N/4P3/5PPP/2RR2K1 b - -",
    "5rk1/1p3p1p/4bp2/1q2p3/rp2Q2N/4P3/5PPP/2RR2K1 w - -",
    "5rk1/1p3p1p/4bp2/1q2p3/rp5N/4PQ2/5PPP/2RR2K1 b - -",
    "5r2/1p3pkp/4bp2/1q2p3/rp5N/4PQ2/5PPP/2RR2K1 w - -",
    "5r2/1p3pkp/4bp2/1q2pN2/rp6/4PQ2/5PPP/2RR2K1 b - -",
    "5r2/1p3pkp/5p2/1q2pb2/rp6/4PQ2/5PPP/2RR2K1 w - -",
    "5r2/1p3pkp/5p2/1q2pQ2/rp6/4P3/5PPP/2RR2K1 b - -",
    "5r2/1p3pkp/5p2/1q2pQ2/r7/1p2P3/5PPP/2RR2K1 w - -",
    "5r2/1p3pkp/3R1p2/1q2pQ2/r7/1p2P3/5PPP/2R3K1 b - -",
    "5r2/1p3pkp/3R1p2/1q2pQ2/r7/4P3/1p3PPP/2R3K1 w - -",
    "5r2/1p3pkp/3R1Q2/1q2p3/r7/4P3/1p3PPP/2R3K1 b - -",
    "5rk1/1p3p1p/3R1Q2/1q2p3/r7/4P3/1p3PPP/2R3K1 w - -",
    "5rk1/1p3p1p/3R4/1q2p1Q1/r7/4P3/1p3PPP/2R3K1 b - -",
    "5r1k/1p3p1p/3R4/1q2p1Q1/r7/4P3/1p3PPP/2R3K1 w - -",
    "5r1k/1p3p1p/3R1Q2/1q2p3/r7/4P3/1p3PPP/2R3K1 b - -"
  ]
}
```
