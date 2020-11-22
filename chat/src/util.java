import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;

public class util {
    public String displayTime(){
        DateFormat dateFormat = new SimpleDateFormat("hh.mm aa");
        return dateFormat.format(new Date()).toString();
    }
}
