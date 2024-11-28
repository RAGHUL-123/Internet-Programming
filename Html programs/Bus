import java.sql.*;
import java.util.Scanner;

public class BusReservationSystem {
    // Database credentials
    private static final String URL = "jdbc:mysql://localhost:3306/Bussystem";
    private static final String USER = "root";
    private static final String PASSWORD = "3278";

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        while (true) {
            System.out.println("\nBus Reservation System");
            System.out.println("1. Add Bus");
            System.out.println("2. View Buses");
            System.out.println("3. Update Bus Seats");
            System.out.println("4. Delete Bus");
            System.out.println("5. Exit");
            System.out.print("Enter your choice: ");
            int choice = scanner.nextInt();
            scanner.nextLine(); // Consume newline

            switch (choice) {
                case 1:
                    addBus(scanner);
                    break;
                case 2:
                    viewBuses();
                    break;
                case 3:
                    updateBusSeats(scanner);
                    break;
                case 4:
                    deleteBus(scanner);
                    break;
                case 5:
                    System.out.println("Exiting...");
                    scanner.close();
                    System.exit(0);
                    break;
                default:
                    System.out.println("Invalid choice. Please try again.");
            }
        }
    }

    // Method to add a bus
    private static void addBus(Scanner scanner) {
        System.out.print("Enter Bus Name: ");
        String name = scanner.nextLine();
        System.out.print("Enter Bus Route: ");
        String route = scanner.nextLine();
        System.out.print("Enter Number of Seats: ");
        int seats = scanner.nextInt();
        scanner.nextLine(); // Consume newline

        String sql = "INSERT INTO buses (name, route, seats) VALUES (?, ?, ?)";

        try (Connection conn = DriverManager.getConnection(URL, USER, PASSWORD);
             PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setString(1, name);
            pstmt.setString(2, route);
            pstmt.setInt(3, seats);
            pstmt.executeUpdate();
            System.out.println("Bus added successfully!");
        } catch (SQLException e) {
            e.printStackTrace();
            System.out.println("Failed to add bus!");
        }
    }

    // Method to view all buses
    private static void viewBuses() {
        String sql = "SELECT * FROM buses";

        try (Connection conn = DriverManager.getConnection(URL, USER, PASSWORD);
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {

            while (rs.next()) {
                int id = rs.getInt("id");
                String name = rs.getString("name");
                String route = rs.getString("route");
                int seats = rs.getInt("seats");
                System.out.println("ID: " + id + ", Name: " + name + ", Route: " + route + ", Seats: " + seats);
            }

        } catch (SQLException e) {
            e.printStackTrace();
            System.out.println("Failed to retrieve buses!");
        }
    }

    // Method to update bus seats
    private static void updateBusSeats(Scanner scanner) {
        System.out.print("Enter Bus ID to update: ");
        int id = scanner.nextInt();
        scanner.nextLine(); // Consume newline
        System.out.print("Enter new number of seats: ");
        int newSeats = scanner.nextInt();
        scanner.nextLine(); // Consume newline

        String sql = "UPDATE buses SET seats = ? WHERE id = ?";

        try (Connection conn = DriverManager.getConnection(URL, USER, PASSWORD);
             PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(1, newSeats);
            pstmt.setInt(2, id);
            int rowsUpdated = pstmt.executeUpdate();
            if (rowsUpdated > 0) {
                System.out.println("Bus seats updated successfully!");
            } else {
                System.out.println("Bus not found!");
            }
        } catch (SQLException e) {
            e.printStackTrace();
            System.out.println("Failed to update bus seats!");
        }
    }

    // Method to delete a bus
    private static void deleteBus(Scanner scanner) {
        System.out.print("Enter Bus ID to delete: ");
        int id = scanner.nextInt();
        scanner.nextLine(); // Consume newline

        String sql = "DELETE FROM buses WHERE id = ?";

        try (Connection conn = DriverManager.getConnection(URL, USER, PASSWORD);
             PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(1, id);
            int rowsDeleted = pstmt.executeUpdate();
            if (rowsDeleted > 0) {
                System.out.println("Bus deleted successfully!");
            } else {
                System.out.println("Bus not found!");
            }
        } catch (SQLException e) {
            e.printStackTrace();
            System.out.println("Failed to delete bus!");
        }
    }
}