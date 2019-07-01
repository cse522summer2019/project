package databaseConnection;

import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.LinkedHashMap;
import java.util.List;
import java.io.FileNotFoundException;
import java.io.FileWriter;
import java.io.IOException;
import java.lang.reflect.InvocationTargetException;
import java.sql.DatabaseMetaData;

public class CalculateScores {

	public static void main(String[] args) throws ClassNotFoundException, SQLException, IOException {
		boolean empty = true;
		boolean emptyRs3 = true;
		HashMap<String, Float> map  = new LinkedHashMap<String, Float>();
		List<String> list = new ArrayList<String>(); 
		float individualSum = 0;
		float normalizedScore = 0;
		float totalSum = 0;
		float totalIndividualSum = 0;
		try {
			//Connect to database
			java.sql.Connection con = DriverManager.getConnection("jdbc:mysql://tethys.cse.buffalo.edu:3306/cse442_542_2019_summer_teamb_db"
					,"schaure","50291848");

			//Execute query
			//Get courseId from the course name
			Statement statement = con.createStatement();
			PreparedStatement pst = con.prepareStatement("select courseid from Courses where coursename = ?");
			pst.setString(1,args[0].toString()); //
			ResultSet rs = pst.executeQuery();
			
			//Iterate over courseID
			while(rs.next()) {
				empty = false;
				int courseId = rs.getInt("courseid");
				//From courseId, get studentID of students who have enrolled for the course
				pst = con.prepareStatement("select distinct studentid from StudentCourses where courseid = ? ");
				pst.setInt(1, courseId);
				ResultSet pstRs = pst.executeQuery();
				
				//Iterate over srudentIds
				while(pstRs.next()) {
					individualSum = 0;
					totalIndividualSum = 0;
					
					//Get names of students
					pst = con.prepareStatement("select emailaddress from Logininfo where studentid = ?");
					pst.setInt(1, pstRs.getInt("studentid"));
					ResultSet rs3 = pst.executeQuery();
					while(rs3.next()) {
						emptyRs3 = false;
						System.out.println(rs3.getString("emailaddress"));
						list.add(rs3.getString("emailaddress"));
					}
				}
			}
					
		}
		catch (Exception e) {
			// TODO: handle exception
			System.out.println("Not able to connect to database. Please check your network");
		}
		
	}
}
