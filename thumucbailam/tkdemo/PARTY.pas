const   fi='PARTY.INP';
        fo='PARTY.OUT';
        nmax=1000;
type    data=longint;
var
        f:text;
        A,b:array[0..nmax+1] of data;
        dd:array[0..nmax+1] of boolean;
        n,m:data;

procedure docfile;
var     i,j:data;
begin
        assign(f,fi); reset(f);
        readln(f,n,m);
        for i:=1 to m do
                read(f,a[i],b[i]);
        close(f);

end;

procedure xuli;
var     i,j,res,min:data;
begin
        min:=high(data);
        for i:=1 to m do
                begin
                        res:=1;
                        res:=0;
                        for j:=1 to n do dd[j]:=false;
                        dd[a[i]]:=true;
                        dd[b[i]]:=true;
                        for j:=1 to m do
                                if (not dd[a[j]]) and (not dd[b[j]]) then
                                        begin
                                                dd[a[j]]:=true;
                                                dd[b[j]]:=true;
                                                inc(res);
                                        end;
                        for j:=1 to m do
                                if (not dd[a[j]]) or (not dd[b[j]]) then
                                        begin
                                                dd[a[j]]:=true;
                                                dd[b[j]]:=true;
                                                inc(res);
                                        end;
                        if res<min then
                                min:=res;
                end;
        assign(f,fo); rewrite(f);
        writeln(f,min);
        close(f);

end;

begin
        docfile;
        xuli;
       // readln;
end.
