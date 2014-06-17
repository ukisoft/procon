import java.util.Iterator;

public class MyLinkedList// implements Iterable, Iterator
{

    private class Node
    {
        Object object = null;
        Node nextNode = null;

        Node(Object object)
        {
            this.object = object;
        }

        public boolean hasNext()
        {
            if (nextNode == null) {
                return false;
            }
            return true;
        }

        @Override
        public String toString()
        {
            return object.toString();
        }
    }


    private Node firstNode;

    MyLinkedList()
    {
        this.firstNode = null;
    }

    MyLinkedList(Object... objects)
    {
        Node previousNode = this.firstNode = new Node(objects[0]);

        for (int i = 1; i < objects.length; i++) {
            Node nextNode = new Node(objects[i]);
            previousNode.nextNode = nextNode;
            previousNode = nextNode;
        }
    }

    public boolean add(Object object)
    {
        if (this.firstNode == null) {
            this.firstNode = new Node(object);
            return true;
        }

        Node previousNode = this.firstNode;
        while (previousNode.hasNext()) {
            previousNode = previousNode.nextNode;
        }

        previousNode.nextNode = new Node(object);
        return true;
    }

    public boolean contains(Object object)
    {
        if (this.firstNode == null) {
            return false;
        }

        Node previousNode = this.firstNode;
        while (previousNode.hasNext()) {
            if (previousNode.object.equals(object)) {
                return true;
            }
            previousNode = previousNode.nextNode;
        }
        return false;
    }

    public Object get(int index)
    {
        if (index == 0) {
            if (this.firstNode == null) {
                throw new ArrayIndexOutOfBoundsException(index);
            }
            return this.firstNode.object;
        }

        Node previousNode = this.firstNode;
        for (int i = 1; i <= index; i++) {
            previousNode = previousNode.nextNode;
            if (previousNode == null) {
                throw new ArrayIndexOutOfBoundsException(index);
            }
        }
        return previousNode.object;
    }

    public Object set(int index, Object object)
    {
        if (index == 0) {
            if (this.firstNode == null) {
                throw new ArrayIndexOutOfBoundsException(index);
            }
            Object oldObject = this.firstNode.object;
            this.firstNode.object = object;
            return oldObject;
        }

        Node previousNode = this.firstNode;
        for (int i = 1; i <= index; i++) {
            previousNode = previousNode.nextNode;
            if (previousNode == null) {
                throw new ArrayIndexOutOfBoundsException(index);
            }
        }
        Object oldObject = previousNode.object;
        previousNode.object = object;
        return oldObject;
    }

    public int size()
    {
        if (this.firstNode == null) {
            return 0;
        }

        Node previousNode = this.firstNode;
        int i = 1;
        for (; previousNode.hasNext(); i++) {
            previousNode = previousNode.nextNode;
        }
        return i;
    }

    public Object remove(int index)
    {
        if (index == 0) {
            if (this.firstNode == null) {
                throw new ArrayIndexOutOfBoundsException(index);
            }

            Object oldObject = this.firstNode.object;
            this.firstNode = this.firstNode.nextNode;
            return oldObject;
        }

        Node previousNode = this.firstNode;
        for (int i = 1; i < index; i++) {
            previousNode = previousNode.nextNode;
            if (previousNode == null) {
                throw new ArrayIndexOutOfBoundsException(index);
            }
        }

        if (previousNode.hasNext() == false) {
            throw new ArrayIndexOutOfBoundsException(index);
        }

        Object oldObject = previousNode.nextNode.object;
        previousNode.nextNode = previousNode.nextNode.nextNode;
        return oldObject;
    }

    public void insert(int index, Object object)
    {
        if (index == 0) {
            if (this.firstNode == null) {
                this.firstNode = new Node(object);
                return;
            }
            Node nextNode = this.firstNode;
            this.firstNode = new Node(object);
            this.firstNode.nextNode = nextNode;
            return;
        }

        Node previousNode = this.firstNode;
        for (int i = 1; i < index; i++) {
            previousNode = previousNode.nextNode;
            if (previousNode == null) {
                throw new ArrayIndexOutOfBoundsException(index);
            }
        }

        Node nextNode = previousNode.nextNode;
        previousNode.nextNode = new Node(object);
        previousNode.nextNode.nextNode = nextNode;
    }

    @Override
    public String toString()
    {
        StringBuilder stringBuilder = new StringBuilder();
        if (this.firstNode == null) {
            stringBuilder.append("no node");
        }

        stringBuilder.append(this.firstNode);
        Node previousNode = this.firstNode;

        while (previousNode.hasNext()) {
            previousNode = previousNode.nextNode;
            stringBuilder.append(", " + previousNode);
        }

        return stringBuilder.toString() + "\n";

    }
}
