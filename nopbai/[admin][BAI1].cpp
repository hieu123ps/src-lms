#include<iostream>
using namespace std;

int main(){
    int n = 6;
    int i = 1, j = 2;
    int temp = 0;
    while(i < j){
        temp = i + j;
        sum += temp;
        if(sum == n){cout << i << ":" << j << endl; continue;}
        if(sum < n){j+=1;continue;}
        if(sum > n){i++; j = i + 1;continue;}
    }
}
