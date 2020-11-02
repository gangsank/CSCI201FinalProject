
import java.io.*;
import java.net.*;
import java.util.*;

public class ClientThread extends Thread {

	private BufferedReader br;
	private PrintWriter pw;
	private String name ; 
	private Socket s ; 

	public ClientThread(String hostname, int port)
	{
		try {
			System.out.println("Starting Client") ;
			s = new Socket(hostname, port) ; 
			System.out.println("Client Started") ; 

			br = new BufferedReader(new InputStreamReader(s.getInputStream())) ; 
			pw = new PrintWriter(s.getOutputStream(), true) ; 

			this.start() ; 
			Scanner scan = new Scanner(System.in) ; 
			System.out.println("Enter your name") ; 
			name = scan.nextLine() ; 
			while (true)
			{
				String out = scan.nextLine() ; 
				if(out.equals("Resolved")) {
					// student's problem is resolved, close the chat 
					try {
						// closing resources 
						pw.println(out) ; 
						br.close() ; 
						pw.close() ; 
						s.close() ; 
						break ; 
					}
					catch (IOException ex ) { ex.printStackTrace() ; }
					break ; 
				}
				pw.println(name + ": " + out) ; 
			}
 		} catch (IOException ex) {ex.printStackTrace() ;} 
	}


	public void run()
	{
		try 
		{
			while (true)
			{
				String line = br.readLine() ; 
				System.out.println(line) ; 
			}
		}
		catch (IOException ex) {System.out.println("Connection Closed") ; }
	}

	public static void main(String [] args)
	{
		new ClientThread("localhost", 6789);
	}
}
