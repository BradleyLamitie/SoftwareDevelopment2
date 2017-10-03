#include <bits/stdc++.h>
using namespace std;

typedef pair<int, int> ii;
typedef vector<int> vi;
typedef vector<ii> vii;
#define INF 1e9+1

int V, E, s, a, b, w, q;
vector<vii> AdjList;
bool negCycle[1000], negCycle2[1000];

void dfs(int u) {
  if (negCycle2[u]) return;
  negCycle2[u] = true;
  for (int j = 0; j < AdjList[u].size(); j++)
    dfs(AdjList[u][j].first);
}

int main() {

  while (scanf("%d %d %d %d", &V, &E, &q, &s)) {
    if (V == 0 && E == 0 && q == 0 && s == 0) break;

    memset(negCycle, false, sizeof negCycle);
    memset(negCycle2, false, sizeof negCycle2);
    AdjList.assign(V, vii()); // assign blank vectors of pair<int, int>s to AdjList
    for (int i = 0; i < E; i++) {
      scanf("%d %d %d", &a, &b, &w);
      AdjList[a].push_back(ii(b, w));
    }

    // Bellman Ford routine
    vi dist(V, INF); dist[s] = 0;
    for (int i = 0; i < V - 1; i++)  // relax all E edges V-1 times, overall O(VE)
      for (int u = 0; u < V; u++) {                       // these two loops = O(E)
        if (dist[u] == INF) continue;
        for (int j = 0; j < (int)AdjList[u].size(); j++) {
          ii v = AdjList[u][j];        // we can record SP spanning here if needed
          dist[v.first] = min(dist[v.first], dist[u] + v.second);         // relax
        }
      }

    for (int u = 0; u < V; u++) {                          // one more pass to check
      if (dist[u] == INF) continue;
      for (int j = 0; j < (int)AdjList[u].size(); j++) {
        ii v = AdjList[u][j];
        if (dist[v.first] > dist[u] + v.second)                 // should be false
          negCycle[u] = true;     // but if true, then negative cycle exists!
      }
    }

    for (int i = 0; i < V; i++)
      if (negCycle[i]) dfs(i);

    for (int i = 0; i < q; i++) {
      int in;
      scanf("%d", &in);
      if (dist[in] == INF) printf("Impossible\n");
      else if (negCycle2[in]) printf("-Infinity\n");
      else printf("%d\n", dist[in]);
    }
    printf("\n");

    for(int i = 0; i < V; i++) {
      AdjList[i].clear();
    }
  }
  return 0;
}