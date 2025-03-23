#include <stdio.h>
#include <math.h>

// Function to calculate the minimum cost
long long minimum_cost(long long n) {
    // Find the smallest r such that r^2 >= n
    long long r = ceil(sqrt((double)n));
    return r - 1; // Cost is r - 1
}

int main() {
    int t;
    scanf("%d", &t); // Read number of test cases

    while (t--) {
        long long n;
        scanf("%lld", &n); // Read the number of trees for each test case
        printf("%lld\n", minimum_cost(n));
    }

    return 0;
}
