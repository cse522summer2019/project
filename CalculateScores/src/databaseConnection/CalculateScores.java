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
						list.add(rs3.getString("emailaddress"));
					}
					//Get evaluation
					String sql = "select * from Evaluationdata inner join Logininfo on Evaluationdata.studentid = Logininfo.studentid "
							+ " and Evaluationdata.studentid = ? and Evaluationdata.courseid = ?";
					pst = con.prepareStatement(sql);
					pst.setInt(1, pstRs.getInt("studentid"));
					pst.setInt(2, courseId);
					ResultSet rs2 = pst.executeQuery();
					while(rs2.next()) {
						//emptyRs2 = false;
						individualSum =  rs2.getInt("role")+rs2.getInt("participation")
						+rs2.getInt("professionalism")+rs2.getInt("leadership")
						+rs2.getInt("quality");
						totalIndividualSum = totalIndividualSum+individualSum;
						map.put(rs2.getString("emailaddress"),totalIndividualSum);
						totalSum = totalSum + individualSum;
					}
				}
			}
			if(empty == false && emptyRs3==false ) {
				FileWriter csvWriter = null;
				//Write to csv file.
				if(args[1].contains(".")) {
					 csvWriter = new FileWriter(args[1]);
				}
				else {
					 csvWriter = new FileWriter(args[1]+".csv");
				}
				DecimalFormat twoDForm = new DecimalFormat("#.#");
				System.out.println("Name \t\t\t\t\t"+"Score");
				csvWriter.append("Normalised scores");
				csvWriter.append("\n");
				csvWriter.append("Email");
				csvWriter.append(",");
				csvWriter.append("Score");
				for(String k : list) {
					csvWriter.append("\n");
					csvWriter.append(k);
					csvWriter.append(",");
					if(map.get(k)!=null) {
						normalizedScore =(map.get(k)/totalSum);
						csvWriter.append(twoDForm.format(normalizedScore).toString());
						System.out.println(k +"\t\t\t"+ twoDForm.format(normalizedScore));
					}
					else {
						System.out.println(k +"\t\t\t"+"0");
						csvWriter.append("0");	
					}
				}
				csvWriter.flush();  
				csvWriter.close();
			}
			else if(emptyRs3==true && empty == false)
				System.out.println("No students enrolled in this course.");
			else
				System.out.println("No course of this name.");
		}
		catch (Exception e) {
			// TODO: handle exception
			System.out.println("Not able to connect to database. Please check your network");
		}
		
	}
}
