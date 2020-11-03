import java.io.*;
import java.net.Socket;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.concurrent.*;

public class ServerThread extends Thread {
    private SimpleDateFormat sdf;
    private PrintWriter dout;
    private BufferedReader din;
    private ChatRoom cr;


    public ServerThread(Socket s, ChatRoom cr)
    {
        try
        {
            this.cr = cr;
            dout = new PrintWriter(s.getOutputStream(), true);
            din = new BufferedReader(new InputStreamReader(s.getInputStream()));
            start();
        }
        catch (IOException ex) {ex.printStackTrace();}
    }

    public void sendMessage(String message)
    {
        dout.println(message);
    }

    public void run()
    {
        try {
            while(true)
            {
                String line = din.readLine();
                if(line == null) break;
                cr.broadcast(line);   // Send text back to the clients
            }
        }
        catch (Exception ex) {System.out.println("Connection reset"); }
        finally {
            try {
                dout.close();
                din.close();
            }
            catch (Exception ex) {ex.printStackTrace();}
        }//finally
    }
}
