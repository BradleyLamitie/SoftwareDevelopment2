package SidewaysSorting;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.io.IOException;
import java.util.Scanner;

public class Sideways {
	 public static void main(String[] args)throws IOException{
		    Scanner scan;           
	        List<String> list = new ArrayList<String>();
	        List<String> list1 = new ArrayList<String>();
		    scan = new Scanner(System.in);
		    while(scan.hasNext()){
		    	int num = scan.nextInt();
		    	int num1 = scan.nextInt();
		    	for(int i = 0; i<num -1; i++){
		    		String word = "";

		    		for(int j=0; j<num1; j++){
		    		list.add(scan.next());
		    		word.concat(list.get(j).substring(i,i+1));
		    		}
		    		list1.add(word);
		    	}
		    	Collections.sort(list1);
		    	for(int i = 0; i<num -1; i++){
		    		String word = "";

		    		for(int j=0; j<num1; j++){
		    		list.add(scan.next());
		    		word.concat(list.get(i).substring(j,j+1));
		    		}
		    		
		    	System.out.println(word);
		    	}
		    }
	 }
}
