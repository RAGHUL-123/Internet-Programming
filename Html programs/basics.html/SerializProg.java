import java.io.*; 
class SerializProg 
{ 
 public static void main(String[] args)throws ClassNotFoundException,IOException 
 { 
 Myclass myobject=new Myclass("Parth",10);//creating the object 
 System.out.println("The object is: "+myobject);//displaying the contents of the object 
 ObjectOutputStream o=new ObjectOutputStream(new FileOutputStream("object.txt")); 
 o.writeObject(myobject);//writing the object to a file 
 o.flush(); 
 o.close(); 
        ObjectInputStream i=new ObjectInputStream(new FileInputStream("object.txt")); 
Myclass newobject=(Myclass)(i.readObject());//reading the object from the file 
        i.close(); 
        System.out.println("\nYou have stored :"+newobject);//displaying the object’s value 
 }   
 static class Myclass implements Serializable 
 { 
  String name; 
  int roll; 
  public  Myclass(String n,int r) 
  { 
   this.name=n; 
   this.roll=r;  
  } 
  public String toString() 
  { 
    return "name= "+name+" and roll= "+roll; 
  } 
 } 
}