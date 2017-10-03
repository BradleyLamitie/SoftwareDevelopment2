#include <bits/stdc++.h>
using namespace std;

#define EPS 1e-9

double RAD_to_DEG(double r) { return r * 180.0 / M_PI; }

struct PT { 
  double x, y; 
  PT() {}
  PT(double x, double y) : x(x), y(y) {}
  PT(const PT &p) : x(p.x), y(p.y)    {}
  PT operator + (const PT &p)  const { return PT(x+p.x, y+p.y); }
  PT operator - (const PT &p)  const { return PT(x-p.x, y-p.y); }
  PT operator * (double c)     const { return PT(x*c,   y*c  ); }
  PT operator / (double c)     const { return PT(x/c,   y/c  ); }
  bool operator == (PT other) const {
   return (fabs(x - other.x) < EPS && (fabs(y - other.y) < EPS));
  }
};

struct vec { double x, y;  // name: `vec' is different from STL vector
  vec(double _x, double _y) : x(_x), y(_y) {} 
};

double cross(vec a, vec b) { return a.x * b.y - a.y * b.x; }

double dot(vec a, vec b) { return (a.x * b.x + a.y * b.y); }

double norm_sq(vec v) { return v.x * v.x + v.y * v.y; }

vec toVec(PT a, PT b) {       // convert 2 points to vector a->b
  return vec(b.x - a.x, b.y - a.y); 
}

double angle(PT a, PT o, PT b) {  // returns angle aob in rad
  vec oa = toVec(o, a), ob = toVec(o, b);
  return acos(dot(oa, ob) / sqrt(norm_sq(oa) * norm_sq(ob))); 
}

// line segment p-q intersect with line A-B.
PT lineIntersectSeg(PT p, PT q, PT A, PT B) {
  double a = B.y - A.y;
  double b = A.x - B.x;
  double c = B.x * A.y - A.x * B.y;
  double u = fabs(a * p.x + b * p.y + c);
  double v = fabs(a * q.x + b * q.y + c);
  return PT((p.x * v + q.x * u) / (u+v), (p.y * v + q.y * u) / (u+v)); }

// cuts polygon Q along the line formed by point a -> point b
// (note: the last point must be the same as the first point)
vector<PT> cutPolygon(PT a, PT b, const vector<PT> &Q) {
  vector<PT> P;
  for (int i = 0; i < (int)Q.size(); i++) {
    double left1 = cross(toVec(a, b), toVec(a, Q[i])), left2 = 0;
    if (i != (int)Q.size()-1) left2 = cross(toVec(a, b), toVec(a, Q[i+1]));
    if (left1 > -EPS) P.push_back(Q[i]);       // Q[i] is on the left of ab
    if (left1 * left2 < -EPS)        // edge (Q[i], Q[i+1]) crosses line ab
      P.push_back(lineIntersectSeg(Q[i], Q[i+1], a, b));
  }
  if (!P.empty() && !(P.back() == P.front()))
    P.push_back(P.front());        // make P's first point = P's last point
  return P; 
}

vector<PT> pts;

int main() {
    int n;
    while(scanf("%d", &n)) {
        if (n == 0) break;

        pts.clear();
        for (int i = 0; i < n; i++) {
            int x, y;
            scanf("%d %d", &x, &y);
            pts.push_back(PT(x, y));
        }

        // pts.push_back(pts.front());
        // pts.push_back(pts[1]);

        double prevMinAngle;
        int cnt = 0;
        vector<PT> prevPts;
        vector<PT> output = pts;

        while(true) {
            double minAngle = M_PI;
            int minIndex = 0;

            for (int i = 0; i < n; i++) {
                double currAngle = angle(output[i], output[(i+1)%n], output[(i+2)%n]);
                if (currAngle < minAngle) {
                    minAngle = currAngle;
                    minIndex = i;
                }
            }

            // cout << minIndex << endl;

            // cout << "prevMinAngle: " << RAD_to_DEG(prevMinAngle) << " minAngle: " << RAD_to_DEG(minAngle) << endl;
            if (cnt != 0 && minAngle-prevMinAngle < EPS) {
                output = prevPts;
                break;
            } else if (n == 3)
                break;
            prevPts = output;
            output.erase(output.begin() + (minIndex + 1)%n);

            cnt++;
            n--;
			prevMinAngle = minAngle;
        }
    
        printf("%d ", (int)output.size());
        for (int i = 0; i < output.size(); i++) {
            printf("%.0f %.0f ", output[i].x, output[i].y);
        }
        printf("\n");
    }
    return 0;
}