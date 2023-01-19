const   fi='CHESS.inp';
        fo='CHESS.out';
        nmax=10000;

type    data=longint;
        mang=array[0..nmax+1] of data;
var
        f:text;
        A,b,vta,vtb,valres,s:mang;
        ns:data;

        demA:array[0..100,0..nmax+1] of data;
        sptA,dd:array[-100..100] of data;
        ddb,free:array[0..nmax+1] of boolean;
        n:data;

procedure docfile;
var     i,j:data;
begin
        assign(f,fi); reset(f);
        readln(f,n);
        for i:=1 to n do
                begin
                        read(f,a[i],b[i]);
                        vta[i]:=i;
                        vtb[i]:=i;
                end;
        close(f);
end;

procedure swap(var a,b:data);
var     z:data;
begin
        z:=a;
        a:=b;
        b:=z;
end;

procedure sort(l,r: longint; var a,vt:mang);
      var
         i,j,x,y: longint;
      begin
         i:=l; j:=r; x:=a[(l+r) div 2];
         repeat
           while a[i]<x do inc(i);
           while x<a[j] do dec(j);
           if not(i>j) then
             begin
                swap(a[i],a[j]);
                swap(vt[i],vt[j]);
                inc(i);
                j:=j-1;
             end;
         until i>j;
         if l<j then sort(l,j,a,vt);
         if i<r then sort(i,r,a,vt);
      end;

procedure xuli;
var     i,j,cl,point,tmp:data;
begin
        fillchar(spta,sizeof(spta),0);
        fillchar(ddb,sizeof(ddb),false);
        fillchar(valres,sizeof(valres),0);
        for i:=1 to n do
                begin
                        inc(spta[a[i]]);
                        dema[a[i],spta[a[i]]]:=i;
                end;
        dd:=spta;
        sort(1,n,a,vta);
        sort(1,n,b,vtb);

        cl:=abs(b[n]-a[1]);
        point:=0;
        // uu tien thang
        for i:=1 to cl do
                begin
                        for j:=1 to n do
                                if not ddb[j] then
                                begin
                                        if dd[b[j]-i]>0 then
                                                begin
                                                        dec(dd[b[j]-i]);
                                                        valres[j]:=b[j]-i;
                                                        ddb[j]:=true;
                                                        inc(point,2);
                                                end;
                                end;
                end;
        // chenh lech 0, uu tien hoa
        i:=0;
        begin
                        for j:=1 to n do
                                if not ddb[j] then
                                begin
                                        if dd[b[j]-i]>0 then
                                                begin
                                                        dec(dd[b[j]-i]);
                                                        valres[j]:=b[j]-i;
                                                        ddb[j]:=true;
                                                        inc(point,1);
                                                end;
                                end;
                end;




        for i:=1 to n do
                if valres[i]<>0 then
                        begin
                                tmp:=dema[valres[i],spta[valres[i]]];
                                dec(dema[valres[i],spta[valres[i]]]);
                                valres[i]:=tmp;
                        end;

        fillchar(free,sizeof(free),false);
        for i:=1 to n do
                free[valres[i]]:=true;
        ns:=0;
        for i:=1 to n do
                if not free[i] then
                        begin
                                inc(ns);
                                s[ns]:=i;
                        end;

        for i:=1 to n do
                if valres[i]=0 then
                        begin
                                valres[i]:=s[ns];
                                dec(ns);
                        end;

        sort(1,n,vtb,valres);

        assign(f,fo); rewrite(f);
        writeln(f,point);
//        for i:=1 to n do  writeln(f,valres[i]);
        close(f);
end;

begin
        docfile;
        xuli;
end.
