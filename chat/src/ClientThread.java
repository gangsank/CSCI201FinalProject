import java.io.*;
import java.net.*;
import java.util.*;

public class ClientThread extends Thread {
    private BufferedReader din;
    private PrintWriter dout;
    private user userPerm;
    private Socket s;

    public ClientThread(String hostname, int port, user user1) throws IOException {
        try {
            s = new Socket(hostname, port);
            din = new BufferedReader(new InputStreamReader(s.getInputStream()));
            dout = new PrintWriter(s.getOutputStream(), true);
            start();
            Scanner scan = new Scanner(System.in);
            dout.println("New participant: " + user1.getUsername());
            while (true) {
                String line = scan.nextLine();
                if (line.equals("quit")) {
                    try {
                        dout.close();
                        din.close();
                        s.close();
                    } catch (IOException ex) {
                        ex.printStackTrace();
                    }
                    break;
                }
                dout.println("@" + user1.getUsername() + ": " + line);
            }
        } catch (IOException ex) {
            throw new IOException("There was a problem with the connection...");
        }
    }

    public void run() {
        try {
            while (true) {
                String line = din.readLine();
                System.out.println(line);
            }
        } catch (IOException ex) {
            System.out.println("Connection closed");
        }
    }

    public static void main(String[] args) throws IOException {
        user newUser1 = new user("Angad", "lol", "Angad Sood", "angadsoo@usc.edu");
        user newUser2 = new user("user1", "lol", "user name", "user@usc.edu");
        new ClientThread("localhost", 6789, newUser1);
        new ClientThread("localhost", 6789, newUser2);

    }
}
