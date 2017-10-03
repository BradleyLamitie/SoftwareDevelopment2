package Backslash;

import java.io.IOException;
import java.util.HashSet;
import java.util.Scanner;
import java.util.Set;

public class Backslash {
	 public static void main(String[] args)throws IOException{
		    Scanner scan;           
		    scan = new Scanner(System.in);
		    Scanner scan2;           
		    Set<String> set = new HashSet<String>();
		    set.add("");
		    set.add("");
		    set.add("");
		    set.add("");
		    set.add("");
		    set.add("");
		    set.add("");
		    set.add("");
		    set.add("");
		    set.add("");
		    set.add("");
		    set.add("");
		    set.add("");

		    //scan = new Scanner(System.in);
		   while(scan.hasNextLine()){ 
			   int caps = scan.nextInt();
			   String line = scan.nextLine();
			   scan2 = new Scanner(line);
			   while(scan2.hasNext()){		    
				   String   word1 = scan.next();
				   String word2 = scan.next();
			   }
		   }
}
}
