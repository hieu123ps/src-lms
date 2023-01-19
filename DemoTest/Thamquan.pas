const   fi='THAMQUAN.INP';
        fo='THAMQUAN.OUT';
        nmax=30000;
type    data=longint;
        mang=array[0..nmax+1] of data;
var
        f:text;
        D,V:mang;
        n,m:data;

procedure docfile;
var     i,j:data;
begin
        assign(f,fi); reset(f);
        readln(f,n,m);
        for i:=1 to n do
                read(f,d[i]);
        for i:=1 to m do
                read(f,v[i]);
        close(f);
end;

procedure swap(var a,b:data);
var     z:data;
begin
        z:=a;
        a:=b;
        b:=z;
end;

procedure sort(l,r: longint; var a:mang);
      var
         i,j,x,y: longint;
      begin
         i:=l;
         j:=r;
         x:=a[(l+r) div 2];
         repeat
           while a[i]<x do inc(i);
           while x<a[j] do dec(j);
           if not(i>j) then
             begin
                swap(a[i],a[j]);
                inc(i);
                j:=j-1;
             end;
         until i>j;
         if l<j then
           sort(l,j,a);
         if i<r then
           sort(i,r,a);
      end;


procedure xuli;
var     i,j,t,p:data;
        res:int64;
begin
        sort(1,n,d);
        sort(1,m,v);
        t:=1;
        p:=n;
        res:=0;
        for i:=1 to n do
                begin
                        res:=res+d[t]*v[p];
                        inc(t);
                        dec(p);
                end;
        assign(f,fo); rewrite(f);
        writeln(f,res);
        close(f);
end;


begin
        docfile;
        xuli;
//        readln;
end.

