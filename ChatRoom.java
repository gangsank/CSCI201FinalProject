import java.io.*;
import java.net.*;
import java.util.concurrent.ArrayBlockingQueue;


public class ChatRoom
{
	private List<ServerThread> serverThreads;

	public ChatRoom(int port)
	{
		try {
			ServerSocket ss = new ServerSocket(port) ; 
			serverThreads = new ArrayList<>(); 
			// accepting all clients 
			while (true){
				Socket s = ss.accept() ; 
				// create a Server Thread to handle each incomig request 
				ServerThread st = new ServerThread(s, this) ; 
				// adding to the queue
				serverThreads.add(st) ; 
			}
		} catch (Exception ex) {}
	}

	public void broadcast(String message, ServerThread st)
	{
		if (message != null ) {

			System.out.println("broadcasting...." + message);
			// traversing the List to send the message to all clients
			for(ServerThread threads : serverThreads)
					threads.sendMessage(message);

		}
	}

	public static void main(String [] args)
	{
		new ChatRoom(6789);
	}
}
