public class Main {

    public static void main(String[] args)
    {
        System.out.println("start test");
        Main.testMyQueue();
    }

    private static void testMyQueue()
    {
        MyQueue myQueue1 = new MyQueue();
        System.out.println(myQueue1);

        MyQueue myQueue2 = new MyQueue("a", "b", "c");
        System.out.println(myQueue2);

        myQueue2.add("d");
        System.out.println(myQueue2);

        try {
            System.out.println(myQueue1.remove());
            System.out.println(myQueue1);
        } catch (NullPointerException e) {
            System.out.println(e);
        }

        try {
            System.out.println(myQueue1.poll());
            System.out.println(myQueue1);
        } catch (NullPointerException e) {
            System.out.println(e);
        }

        System.out.println(myQueue2.remove());
        System.out.println(myQueue2);

        try {
            System.out.println(myQueue1.element());
            System.out.println(myQueue1);
        } catch (NullPointerException e) {
            System.out.println(e);
        }

        try {
            System.out.println(myQueue1.peek());
            System.out.println(myQueue1);
        } catch (NullPointerException e) {
            System.out.println(e);
        }

        System.out.println(myQueue2.element());
        System.out.println(myQueue2);
    }

    private static void testMyVector()
    {
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
            System.out.println(myVector2.get(10));
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

        for (Object object: myVector3) {
            int i = (Integer)object;
            if (i % 2 == 1) myVector3.remove();
        }
        System.out.println(myVector3);

        for (Object object: myVector3) {
            int i = (Integer)object;
            if (i % 3 == 0) myVector3.remove();
        }
        System.out.println(myVector3);

        MyVector myVector4 = new MyVector(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        System.out.println(myVector4);

        for (Object object: myVector4) {
            int i = (Integer)object;
            if (i == 6) {
                System.out.println(i);
                break;
            }
        }

        for (Object object: myVector4) {
            int i = (Integer) object;
            if (i == 2) {
                System.out.println(i);
                break;
            }
        }
    }

    private static void testMyLinkedList()
    {
        MyLinkedList myLinkedList1 = new MyLinkedList();
        System.out.print(myLinkedList1);

        MyLinkedList myLinkedList2 = new MyLinkedList("a", "b", "c");
        System.out.print(myLinkedList2);

        myLinkedList2.add("d");
        myLinkedList2.add("d");
        myLinkedList2.add("d");
        myLinkedList2.add("d");
        myLinkedList2.add("d");
        myLinkedList2.add("d");
        System.out.print(myLinkedList2);

        if (myLinkedList2.contains("a")) System.out.println("myLinkedList2 contains a");
        if (myLinkedList2.contains("e")) System.out.println("myLinkedList2 contains e");

        System.out.println(myLinkedList2.get(2));

        try {
            System.out.println(myLinkedList2.get(10));
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }

        myLinkedList2.set(0, "f");
        System.out.println(myLinkedList2);

        System.out.println(myLinkedList2.size());

        myLinkedList2.remove(0);
        myLinkedList2.remove(3);
        System.out.println(myLinkedList2);

        myLinkedList2.insert(1, "g");
        System.out.println(myLinkedList2);
        System.out.println(myLinkedList2.size());

        MyLinkedList myLinkedList3 = new MyLinkedList(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        System.out.println(myLinkedList3);

        for (Object object: myLinkedList3) {
            System.out.println(object);
        }

//        for (Object object: myLinkedList3) {
//            int i = (Integer)object;
//            if (i % 2 == 1) myLinkedList3.remove();
//        }
//        System.out.println(myLinkedList3);

//        for (Object object: myLinkedList3) {
//            int i = (Integer)object;
//            if (i % 3 == 0) myLinkedList3.remove();
//        }
//        System.out.println(myLinkedList3);

        MyLinkedList myLinkedList4 = new MyLinkedList(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        System.out.println(myLinkedList4);

        for (Object object: myLinkedList4) {
            int i = (Integer)object;
            if (i == 6) {
                System.out.println(i);
                break;
            }
        }

        for (Object object: myLinkedList4) {
            int i = (Integer) object;
            if (i == 2) {
                System.out.println(i);
                break;
            }
        }
    }
}
