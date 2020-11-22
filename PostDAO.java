import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class PostDAO {
	private Connection getConnection() throws SQLException {
		Connection conn = null;
		
		try {
			Class.forName("com.mysql.jdbc.Driver");

            String url = "jdbc:mysql://localhost/test";
            conn = DriverManager.getConnection(url, "test", "test");
		} catch (ClassNotFoundException e) {
			System.out.println("Failed to load the driver");
		}
		
		return conn;
	}
	
	public boolean insert(PostVO vo) {
		boolean result = false;
		Connection conn = null;
		PreparedStatement pstmt = null;
		
		try {
			conn = getConnection();
			
			String sql = "";
			pstmt = conn.prepareStatement(sql);
			
			pstmt.setInt(1,  vo.getPostId());
			pstmt.setInt(2, vo.getClassId());
			pstmt.setInt(3, vo.getUserId());
			pstmt.setBoolean(4, vo.isAnon());
			pstmt.setString(5, vo.getContent());
			pstmt.setString(6, vo.getTitle());
			pstmt.setInt(7, vo.getParentId());
			pstmt.setDate(8, vo.getInitialDate());
			pstmt.setDate(9, vo.getLastEdited());
			int count = pstmt.executeUpdate();
			
			result = (count == 1);
		} catch (SQLException e) {
			e.printStackTrace();
		} finally {
			try {
				if (conn != null) {
					conn.close();
				} if (pstmt != null) {
					pstmt.close();
				}
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}
		
		return result;
	}
}
