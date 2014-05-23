public class Main {

    public static void main(String[] args)
    {
        System.out.println("start MyVector test");

        MyVector myVector1 = new MyVector();
        System.out.println(myVector1);

        MyVector myVector2 = new MyVector("a", "b", "c");
        System.out.println(myVector2);

        myVector2.add("d");
        myVector2.add("d");
        myVector2.add("d");
        myVector2.add("d");
        myVector2.add("d");
        myVector2.add("d");
        System.out.println(myVector2);

        if (myVector2.contains("a")) System.out.println("myVector2 contains a");
        if (myVector2.contains("e")) System.out.println("myVector2 contains e");

        System.out.println(myVector2.get(2));

        try {
            System.out.println(myVector2.get(5));
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }

        myVector2.set(0, "f");
        System.out.println(myVector2);

        System.out.println(myVector2.size());

        myVector2.remove(0);
        System.out.println(myVector2);

        myVector2.insert(1, "g");
        System.out.println(myVector2);

        MyVector myVector3 = new MyVector(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        System.out.println(myVector3);

        while (myVector3.hasNext()) {
            Object object = myVector3.next();
            int i = (Integer)object;
            if (i % 2 == 1) myVector3.remove();
        }
        System.out.println(myVector3);
    }
}
