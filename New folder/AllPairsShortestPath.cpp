#include <algorithm>
#include <cstdio>
using namespace std;

#define INF 1000000000

int main() {
  int V, E, Q, u, v, w, AdjMatrix[200][200];
  
  while(scanf("%d %d %d", &V, &E, &Q)) {
    if (V == 0 & E == 0 & Q == 0) break;
    
    for (int i = 0; i < V; i++) {
      for (int j = 0; j < V; j++)
        AdjMatrix[i][j] = INF;
      AdjMatrix[i][i] = 0;
    }

    for (int i = 0; i < E; i++) {
      scanf("%d %d %d", &u, &v, &w);
      if (AdjMatrix[u][v] > w)
        AdjMatrix[u][v] = w; // directed graph
    }

    for (int k = 0; k < V; k++) // common error: remember that loop order is k->i->j
      for (int i = 0; i < V; i++)
        for (int j = 0; j < V; j++)
          if (AdjMatrix[i][j] > AdjMatrix[i][k] + AdjMatrix[k][j] && AdjMatrix[i][k] != INF && AdjMatrix[k][j] != INF) // A twist from normal FW Algo
            AdjMatrix[i][j] = AdjMatrix[i][k] + AdjMatrix[k][j];

    for (int i = 0; i < V; i++)
      for (int j = 0; j < V; j++)
        for (int k = 0; k < V; k++)
          if (AdjMatrix[i][k] != INF && AdjMatrix[k][j] != INF && AdjMatrix[k][k] < 0)
            AdjMatrix[i][j] = -INF;

    for (int n = 0; n < Q; n++) {
      int i, j;
      scanf("%d %d", &i, &j);
      int out = AdjMatrix[i][j];
      if (out == INF) 
        printf("Impossible\n");
      else if (out == -INF)
        printf("-Infinity\n");
      else
        printf("%d\n", out);
    }
    printf("\n");
  }
  return 0;
}