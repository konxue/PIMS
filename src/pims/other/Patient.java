/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package pims.other;
import java.util.*;
/**
 *
 * @author Nick
 */
public class Patient {
    
    String FName; // Patient first name
    String LName; //Pts last name
    String Middle; // Pts middle name
    String street; //Mailing street
    String city; //Mailing City
    String state; //Mailing state
    String zip; //Mailing zip
    String Hphone; //Home phone
    String Wphone; //Work phone
    String Mphone; // Mobile Phone
    String Econt1Fname; //Emergency contact 1 first name
    String Econt1Lname; //Emergency contact 1 last name
    String Econt1Pnum; // Emergency contact 1 phone Num
    String Econt2Fname; //Emergency contact 2 first name
    String Econt2Lname; //Emergency contact 2 last name
    String Econt2Pnum; // Emergency contact 2 phone Num
    String AdmitM; //Admittance month
    String AdmitD; //Admittance Day
    String AdmitY; //Admittance Year
    String AdmitTime;
    String Reason; //reason for admittance
    String FDocFname; //Family Doctor First Name
    String FDocLname; //Family Doctor Last Name
    String Facility;
    String Floor;
    String Room;
    String BNum;
    String DischM;
    String DischD;
    String DischY;
    String DischTime;
    String DocNotes;
    String NurseNotes;
    String Prescript; //Feild for prescription name, amount, schedule
    String ProcedureSch; //Feild for Procedure name and schedule
    String Insurer; //Insurance carrier
    String InsurAcc; //
    String InsureGrp;
    String BillingRecipt;
    double Paid;
    double Owed;
    double InsurPaid;
    Scanner scanner = new Scanner(System.in);
    
    /**
     * Sets the assigned product variable
     * @param s Is the temporary value for assignment purposes
     */
    public void setPay(double s)
    {
        pay = s;
    }
    /**
     * Sets the assigned product variable
     * @param u Is the temporary value for assignment purposes
     */
    public void setID(int u)
    {
        ID = u;
    }
    /**
     * Sets the assigned product variable
     * @param t Is the temporary value for assignment purposes
     */
    public void setFirstName(String t)
    {
        firstName = t;
    }
    /**
     * Sets the assigned product variable
     * @param s Is the temporary value for assignment purposes
     */
    public void setPosition(String s) 
    {
        position = s;
    }
    /**
     * Sets the assigned product variable
     * @param t Is the temporary value for assignment purposes
     */
    public void setLastName(String t)
    {
        lastName = t;
    }
    /**
     * This retrieves the assigned variable of the product
     * @return It returns the appropriate product variable
     */
    public double getpay()
    {   
        return pay;
    }
    /**
     * This retrieves the assigned variable of the product
     * @return It returns the appropriate product variable
     */
    public String getPosition()
    {   
        return position;
    }
    /**
     * This retrieves the assigned variable of the product
     * @return It returns the appropriate product variable
     */
    public String getFirstName()
    {   
        return firstName;
    }
    /**
     * This retrieves the assigned variable of the product
     * @return It returns the appropriate product variable
     */
    public String getLastName()
    {   
        return lastName;
    }
    /**
     * This retrieves the assigned variable of the product
     * @return It returns the appropriate product variable
     */
    public int getID()
    {
        return ID;
    }
    
    /**
     * This removes staff members from the staff list by taking them out
     * @param newStaff Is the staff ID of the staff member being removed
     */
    @Override
    public void removeStaff(int newStaff)
    {
        Staff staff; //When the staff member is found, they are kept here

        staff = searchStaffbyID(newStaff);

        if(staff != null)
        {
            for(Staff s: BookStore.staff)
            {
                if(s == staff)
                {
                    BookStore.staff.remove(newStaff);
                    break;
                }
            }
        }
        else
        {
            System.out.println("Staff member not found.");
        }
    }
    
    /**
     * This add new staff members to the staff array list "staff"
     * @param newStaff Is the new staff member being newly added as a new entry
     */
    @Override
    public void addStaff(Staff newStaff) 
    {
        Staff unique; //Used to see if the member is already in the list or needs to be added
        
        unique = searchStaffbyID(newStaff.ID);
        
        if (unique == null)
        {
            BookStore.staff.add(newStaff);
        }
        else if(unique != null)
        {
            System.out.println(unique.firstName + unique.lastName + "is already  an employee.");
        }
    }
    
    /**
      * This creates brand new manager objects
      * @param newManager Is the new manager that is being newly created
      */
    @Override
    public void createManager(Manager newManager) 
    {
        int x;
        String y;
        double z;
        System.out.println("ID?");
        x = scanner.nextInt();
            newManager.setID(x);
        System.out.println("First Name?");
        y = scanner.next();
            newManager.setFirstName(y);
        System.out.println("Last Name?");
        y = scanner.next();
            newManager.setLastName(y);
        System.out.println("Pay?");
        z = scanner.nextDouble();
            newManager.setPay(z);
        addStaff(newManager);
    }

    /**
      * This creates brand new cashier objects
      * @param newCashier Is the new cashier that is being newly created
      */
    @Override
    public void createCashier(Cashier newCashier) 
    {
        int x;
        String y;
        double z;
        System.out.println("ID?");
        x = scanner.nextInt();
            newCashier.setID(x);
        System.out.println("First Name?");
        y = scanner.next();
            newCashier.setFirstName(y);
        System.out.println("Last Name?");
        y = scanner.next();
            newCashier.setLastName(y);
        System.out.println("Pay?");
        z = scanner.nextDouble();
            newCashier.setPay(z);
        addStaff(newCashier);
    }

    /**
     * This searches the staff by ID
     * @param key Is the desired ID to be searched 
     * @return This returns either the desired staff member if found, or null if not found
     */
    @Override
    public Staff searchStaffbyID(int key) 
    {
        Staff tempStaff = null; //If the desired staff member is found, they are kept here
        
        for(Staff s: BookStore.staff)
        {
            if(key == s.ID)
            {
                tempStaff = s;
                break;
            }
            else
            {
                tempStaff = null;
            }
        }
        return tempStaff;
    }


}
