import java.io.*;
import java.net.*;
import java.util.*;

public class adminThread extends Thread {
    private BufferedReader din;
    private PrintWriter dout;
    private user userPerm;
    private Socket s;


    public adminThread(String hostname, int port, user user1) throws IOException {
        try {
            s = new Socket(hostname, port);
            System.out.println("As the admin, you now have the privileges to execute commands");
            din = new BufferedReader(new InputStreamReader(s.getInputStream()));
            dout = new PrintWriter(s.getOutputStream(), true);
            start();
            Scanner scan = new Scanner(System.in);
            System.out.println("New participant: " + user1.getUsername());
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
        user newUser2 = new user("user1", "lol", "user name", "user@usc.edu");
        new adminThread("localhost", 6789, newUser2);

    }
}
