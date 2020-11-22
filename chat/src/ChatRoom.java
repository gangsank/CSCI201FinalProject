import java.io.*;
import java.net.*;
import java.text.SimpleDateFormat;
import java.util.*;
import java.util.concurrent.*;

public class ChatRoom {

    private ArrayList<ClientThread> cl;
    private user Admin;
    private boolean connectionPrivateStatus;
    private List<ServerThread> serverThreads;
    util utility = new util();

    public ChatRoom(int port)
    {
        try
        {
            System.out.println("Binding to port " + port);
            ServerSocket ss = new ServerSocket(port);
            serverThreads = new ArrayList<>();
            while(true)
            {
                Socket s = ss.accept();   //  Accept the incoming request
                //System.out.println("Connection from " + s + " at " + new Date());
                ServerThread st = new ServerThread(s, this);

                System.out.println("Adding this client to active client list");
                serverThreads.add(st);
            }
        }
        catch (Exception ex) {}

    }

    public void broadcast(String message)
    {

        if (message != null) {
            System.out.println(utility.displayTime()+": "+ message);
            for(ServerThread threads : serverThreads)
                threads.sendMessage(utility.displayTime()+": "+message);
        }
    }

    public void broadcastAdd(String username){
        if(username!=null){
            System.out.println(utility.displayTime()+": New participant: " + username);
        }
    }

    public static void main(String [] args) throws IOException
    {
        new ChatRoom(6789);
    }
}